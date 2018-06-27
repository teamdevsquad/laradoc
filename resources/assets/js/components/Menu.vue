<template>
    <ul>
        <li v-for="(item, index) in menu" :key="`menu-${index}`">
            <h2>{{ item.title }}</h2>
            <ul>
                <li v-for="(link, index) in item.items" :key="`item-${index}`">
                    <a :href="link.href">{{ link.title }}</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
    export default {
        data: () => ({
            menu: [
                {
                    title: 'Getting Started',
                    items: [
                        { title: 'Introduction', href: '/' }
                    ]
                }
            ]
        })
    }
</script>


