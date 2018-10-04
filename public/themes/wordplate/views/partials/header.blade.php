<header class="top bg-dark">
    <div role="navigation" class="topnav navbar navbar-expand-lg sizeable" >
        <div class="container d-flex justify-content-between full-height">
            <a class="logo" href="/">
                <img src="/themes/wordplate/assets/images/calhoun-county-logo.png" alt="Calhoun County, Florida" class="img-fluid" >
            </a>
            <button @click="toggleMenu" class="d-lg-none btn btn-sm btn-dark mobile-toggle" type="button" data-toggle="collapse" data-target="#mobilemenu" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                MENU <i
                        class="fa" 
                        :class="{
                            'fa-bars': !mobileMenuOpen,
                            'fa-times': mobileMenuOpen
                        }"
                        aria-hidden="true"
                    ></i>
            </button>
            <div class="main-navigation collapse navbar-collapse flex-grow-1 full-height">
                <main-menu :main-nav="{{ website_menu('main-navigation') }}" class="navbar-nav ml-auto full-height sizable"></main-menu>
            </div>
        </div>
    </div>
</header>
<div v-if="mobileMenuOpen" class="mobile-menu" ref="mobileMenuContainer" :class="{ 'open': this.mobileMenuOpen }" >
    <mobile-menu :mobile-nav="{{ website_menu('mobile-navigation') }}" class="navbar-nav m-auto" ></mobile-menu>
</div>
<div class="top-pad"></div>
@include('partials.textsizer')
