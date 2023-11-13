<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategoryTranslation;
use App\Models\MenuTranslation;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ArticleCategoryInterface;
use App\Repositories\Contracts\ArticleInterface;
use App\Repositories\Contracts\MenuCategoryInterface;
use App\Repositories\Contracts\MenuInterface;
use App\Repositories\Contracts\PageInterface;
use App\Repositories\Contracts\ProductCategoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Menu\CreateMenu;

class MenuController extends Controller
{
    protected $articleCategoryRepository, $articleRepository, $menuCategoryRepository, $menuRepository, $pageRepository, $productRepository;

    public function __construct(
        ArticleCategoryInterface $articleCategoryRepository,
        ArticleInterface $articleRepository,
        MenuCategoryInterface $menuCategoryRepository,
        MenuInterface $menuRepository,
        PageInterface $pageRepository,
        ProductCategoryInterface $productRepository
    )
    {
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleRepository = $articleRepository;
        $this->menuCategoryRepository = $menuCategoryRepository;
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $local = request()->query('local','vi');
        $category_id = request()->query('category_id');
        $article_categories = $this->articleCategoryRepository->getAll();
        $product_categories = $this->productRepository->getAll();
        $menu_categories = MenuCategoryTranslation::where(['lang'=> $local ])->get();
        $pages = $this->pageRepository->getAll();
        if ($menu_categories->count() == 0){
            Session::flash('danger', 'Chưa có nhóm menu nào');
            return redirect()->route('admin.menu-category.index');
        }
        if (empty($category_id)){
            $category_id = $menu_categories->first()->menu_category_id;
        }
        $menu = MenuTranslation::where(['category_id'=>$category_id,'lang'=> $local])->withDepth()->defaultOrder()->get()->toTree();
        return view('admin.menu.index', compact('article_categories','menu_categories','menu','category_id','pages','product_categories','local'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMenu $req)
    {
        DB::beginTransaction();
        try {
            $data = $req->validated();
            $menu = $this->menuRepository->create($data);
            $local = request()->input('locale','vi');
            foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties){
                $data2['lang'] = $localeCode;
                $data2['name'] = $localeCode == $local ? $data['name']:null;
                $data2['link'] = $localeCode == $local ? $data['link']:null;
                $data2['name_url'] = $localeCode == $local ? $data['name_url']:null;
                $data2['name_att'] = $localeCode == $local ? $data['name_att']:null;
                $data2['category_id'] = $data['category_id'];
                $langTranslation = new MenuTranslation($data2);
                $menu->translations()->save($langTranslation);
            }
            DB::commit();
            return $menu;
        } catch (\Exception $ex) {
            DB::rollBack();
            \Log::info([
                'message' => $ex->getMessage(),
                'line' => __LINE__,
                'method' => __METHOD__
            ]);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->menuRepository->delete($id);
        MenuTranslation::where('menu_id', $id)->delete();

        return [
            'status' => true,
            'message' => trans('message.delete_menu_success')
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param updateTree $request
     * @return \Illuminate\Http\Response
     */
    public function updateTree(Request $request)
    {
        $local = $request->local;
        $data = $request->data;
//        $this->menuRepository->updateTreeRebuild('id', $data);
        foreach ($data as $item){
            $menu = MenuTranslation::where(['lang'=> $local,'id' => $item['id']]);
            try {
                if(count($menu->get())){
                    $menu->rebuildSubtree('id',$item);
                }else{
                    $data2 = $item;
                    $data2['lang'] = $local;
                    $data2['menu_id'] = $item['id'];
                    $menu->create($data2);
                }
            } catch (\Exception $ex) {
                DB::rollBack();
                \Log::info([
                    'message' => $ex->getMessage(),
                    'line' => __LINE__,
                    'method' => __METHOD__
                ]);
                return false;
            }
        }
        return response()->json($data);
    }
}
