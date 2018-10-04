<template>
    <ul>
        <li v-for="(navitem, index) in mobileNavData" v-bind:key="index" class="nav-item" :class="{'dropdown': navitem.children.length > 0 }">
            <a v-if="navitem.children.length == 0" :href="navitem.url" :class="'nav-link'" :target="navitem.target" >{{ navitem.title }}</a>
            <button v-else class="nav-link btn text-left btn-block border-0" @click="toggleSubMenu(index)" >
                {{ navitem.title }}
                <span class="nav-icon" v-if="navitem.children.length > 0" >
                    <i class="fa" :class="{
                        'fa-plus-circle': !navitem.subMenuOpen,
                        'fa-minus-circle': navitem.subMenuOpen
                        }" ></i>
                </span>
            </button>
            <div class="dropdown-menu" v-if="navitem.subMenuOpen" >
                <li v-for="(child, i) in navitem.children" v-bind:key="i">
                    <a :href="child.url" :class="'nav-link'" :target="child.target" >{{ child.title }}</a>
                </li>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {

        props: {
            mobileNav: {
                type: Object/Array,
                default: () => []
            }
        },

        data() {
            return {
                mobileNavData: {}
            }
        },

        created(){
            this.mobileNavData = Object.keys(this.mobileNav).map((key) => {
                this.mobileNav[key].subMenuOpen = false;
                // if(this.mobileNav[key].children.length > 0){
                //     this.mobileNav[key].subMenuOpen = true;
                // }
                return this.mobileNav[key]
            })
        },

        methods: {
            toggleSubMenu(navitem){
                this.mobileNavData[navitem].subMenuOpen = !this.mobileNavData[navitem].subMenuOpen;
            }
        }

    }
</script>
<style lang="scss" >
.mobile-menu {
    transition: display ease-in .5s;
    display: none;
    
    &.open {
        display: block;
        margin-top: 60px;
        width: 100%;
        height: calc(100vh - 60px);
        z-index: 5;
        padding: 1.5rem;
        color: #FFF;
        position: fixed;
        overflow-y: scroll;

        ul.navbar-nav li button,
        ul.navbar-nav li a {
            font-size: 18px;
            color: #FFF;
            border-radius: 0;
            background-color: transparent;
        }
    } 

    .nav-icon {
        font-size:1.2em;
        padding: .25rem .5rem;
        position: absolute;
        right: 0;
        margin-top: -.4rem;
        cursor: pointer;
        color: #FFF;
    }

    .dropdown-menu {
        border: 0;
        display: block;
        padding: .5rem 1rem;
        border-radius: 0;
    }
}
</style>
