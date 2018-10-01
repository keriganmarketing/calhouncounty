<template>
    <form role="search" method="get" action="/search/" class="form-inline">
        <div class="input-group p-2 bg-white border-bottom border-primary"  style="width:100%;">
            <label class="sr-only" for="search-field">Search for:</label> 
            <input id="search-field" type="search" placeholder="" value="" name="search" class="form-control border-0">
            <div class="input-group-btn">
                <button type="submit" class="btn bg-white border-0">
                    <span class="sr-only">Search</span>
                    <i class="fa fa-search text-primary" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
</template>
<script>
export default {

}
</script>