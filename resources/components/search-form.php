<div class="col-12">
    <form action="<?php echo home_url(); ?>" method="GET" class="search-bar my-4">
        <input name="s" type="text" class="py-2 form-control form-control-sm search-input shadow-sm" placeholder="<?php echo __('البحث', 'qeema'); ?>">

        <button class="btn btn-search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        <input type="hidden" name="post_type" value="product">

        <button class="btn btn-search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>