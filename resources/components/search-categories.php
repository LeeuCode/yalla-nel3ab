<div class="col-12">
    <form hx-get="<?php echo site_url('search/category/'); ?>" hx-target=".categories-container" method="GET" class="search-bar my-4">
        <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

        <input type="hidden" name="type" value="<?php echo (isset($category)) ? $category : ''; ?>">

        <button class="btn btn-search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>