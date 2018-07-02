<template>
    <ul>
        <li v-for="(item, index) in menu" :key="`menu-${index}`" 
            @click="item.isActive = !item.isActive"
        >
            <h2 :class="{'is-active': item.isActive}">{{ item.title }}</h2>
            <ul>
                <li v-for="(link, index) in item.items" :key="`item-${index}`">
                    <a :href="link.href" :class="{'bold': link.isActive}" @click.stop.prevent="goTo(link.href)" >
                        {{ link.title }}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            page   : {required: false, type: String, default: ''},
            version: {required: false, type: String, default: ''},
        },

        data() {
            return {
                oMenu: [],
                menu: []
            }
        },

        async created() {
            await this.getMenu();
        },

        methods: {
            async getMenu() {
                const res = await axios.get('/menu/' + this.version + '/' + this.page);
                this.menu = res.data;
            },

            goTo(href) {
                window.location = href;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .bold {
        font-weight: bold;
    }
</style>



