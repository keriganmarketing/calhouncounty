
<div class="container d-none d-md-flex justify-content-end">
    <div class="text-sizer-section position-absolute">
        <div class="text-sizer d-flex justify-content-end align-items-center rounded mt-4 p-2">
            <span class="m-0 p-0 mx-1 font-weight-bold text-white">TEXT SIZE:</span> 
            <button @click="decreaseTextSize" class="btn btn-white round mx-1"><span class="sr-only">Make text smaller</span><i class="fa fa-minus" aria-hidden="true"></i></button>
            <button @click="resetTextSize" class="btn btn-white round mx-1 reset-button"><span class="sr-only">Reset text size</span><i class="fa" aria-hidden="true">100%</i></button> 
            <button @click="increaseTextSize" class="btn btn-white round mx-1"><span class="sr-only">Make text bigger</span><i class="fa fa-plus" aria-hidden="true"></i></button> 
        </div>
    </div>
</div>