<?php

namespace Admin\Http;

use Numencode\Utils\Imageable;
use Numencode\Models\Promotion\PromotionItem;
use Numencode\Models\Promotion\PromotionCategory;

class PromotionController extends BaseController
{
    /**
     * Display a listing of the promotion categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin::promotion.index', ['promotionCategories' => PromotionCategory::all()]);
    }

    /**
     * Show the form for creating a new promotion category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::promotion.category_create', ['promotionCategories' => PromotionCategory::all()]);
    }

    /**
     * Store a newly created promotion category.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $this->validate(request(), [
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($category = PromotionCategory::create(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::promotion.category_created', ['name' => request()->title])
            );
        }

        return redirect()->route('promotion.index');
    }

    /**
     * Show the promotion category edit form.
     *
     * @param PromotionCategory $promotionCategory Promotion category
     *
     * @return \Illuminate\View\View
     */
    public function edit(PromotionCategory $promotionCategory)
    {
        return view('admin::promotion.category_edit', compact('promotionCategory'));
    }

    /**
     * Update the Promotion category.
     *
     * @param PromotionCategory $promotionCategory Promotion category
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(PromotionCategory $promotionCategory)
    {
        $promotionCategory = PromotionCategory::find($promotionCategory->id);

        $this->validateWithBag('categoryErrors', request(), [
            'title'      => 'required',
            'sort_order' => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        if ($promotionCategory->update(request()->all())) {
            flash()->success(
                trans('admin::messages.success'),
                trans('admin::promotion.category_updated', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('promotion.edit', compact('promotionCategory'));
        }

        return redirect()->route('promotion.index');
    }

    /**
     * List the items in this category.
     *
     * @param PromotionCategory $promotionCategory Promotion category
     *
     * @return \Illuminate\View\View
     */
    public function items(PromotionCategory $promotionCategory)
    {
        return view('admin::promotion.category_items', compact('promotionCategory'));
    }

    /**
     * Delete the Promotion category.
     *
     * @param PromotionCategory $promotionCategory Promotion category
     *
     * @return array
     * @throws \Exception
     */
    public function destroy(PromotionCategory $promotionCategory)
    {
        return $this->deleteThe($promotionCategory, 'promotion.category_deleted');
    }

    /**
     * Edit the promotion item.
     *
     * @param PromotionCategory $promotionCategory Promotion category
     *
     * @return \Illuminate\View\View
     */
    public function createItem(PromotionCategory $promotionCategory = null)
    {
        $categories = PromotionCategory::all();

        return view('admin::promotion.item_create', compact('promotionCategory', 'categories'));
    }

    /**
     * Store a newly created promotion item.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeItem()
    {
        $this->validateWithBag('itemErrors', request(), [
            'promotion_category_id' => 'required',
            'title'                 => 'required',
            'picture'               => 'mimes:jpg,jpeg,png,gif,bmp',
            'sort_order'            => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        $promotionCategory = PromotionCategory::find(request()->promotion_category_id);

        if ($promotionItem = PromotionItem::create(request()->all())) {
            if (request()->picture) {
                $promotionItem->picture = Imageable::createFromFileForPlugin(request()->picture, 'promotions');
            }

            $promotionItem->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::promotion.item_created', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('promotion.item.edit', compact('promotionItem'));
        }

        return redirect()->route('promotion.items', compact('promotionCategory'));
    }

    /**
     * Edit the promotion item.
     *
     * @param PromotionItem $promotionItem Promotion entry
     *
     * @return \Illuminate\View\View
     */
    public function editItem(PromotionItem $promotionItem)
    {
        $categories = PromotionCategory::all();
        $promotionItem = $promotionItem->fresh();

        return view('admin::promotion.item_edit', compact('promotionItem', 'categories'));
    }

    /**
     * Update the promotion item.
     *
     * @param PromotionItem $promotionItem Promotion item
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateItem(PromotionItem $promotionItem)
    {
        $promotionItem = PromotionItem::find($promotionItem->id);

        $this->validateWithBag('itemErrors', request(), [
            'promotion_category_id' => 'required',
            'title'                 => 'required',
            'picture'               => 'mimes:jpg,jpeg,png,gif,bmp',
            'sort_order'            => 'required|integer',
        ]);

        if (request()->ajax()) {
            return success();
        }

        $promotionCategory = PromotionCategory::find(request()->promotion_category_id);

        if ($promotionItem->update(request()->all())) {
            if (request()->picture) {
                if ($promotionItem->picture) {
                    Imageable::deleteFileForPlugin($promotionItem->picture, 'promotions');
                }

                $promotionItem->picture = Imageable::createFromFileForPlugin(request()->picture, 'promotions');
            }

            $promotionItem->save();

            flash()->success(
                trans('admin::messages.success'),
                trans('admin::promotion.item_updated', ['name' => request()->title])
            );
        }

        if (request()->has('redirect') && request()->redirect == 'save') {
            return redirect()->route('promotion.item.edit', compact('promotionItem'));
        }

        return redirect()->route('promotion.items', compact('promotionCategory'));
    }

    /**
     * Delete the promotion item.
     *
     * @param PromotionItem $promotionItem Promotion item
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function destroyItem(PromotionItem $promotionItem)
    {
        if ($promotionItem->picture) {
            Imageable::deleteFileForPlugin($promotionItem->picture, 'promotions');
        }

        return $this->deleteThe($promotionItem, 'promotion.item_deleted');
    }
}
