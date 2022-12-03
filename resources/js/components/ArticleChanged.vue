<template>
    <div class="card" v-if="title">
        <div class="card-header">Изменена статья: <a :href="`/article/${slug}`"  class="art___more">{{ title }}</a></div>
        <div class="card-body">
            <h6>Изменены поля:</h6>
            <div class="change-list">
                <span v-for="change in changes">{{ change }} </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                title: null,
                slug: null,
                changes: [],
            }
        },
        mounted() {
            Echo.private('App.Models.User.1')
                .notification((notification) => {
                    console.log(notification);
                    this.title = notification.title;
                    this.slug = notification.slug;
                    this.changes = notification.changes;
                });
        }
    }
</script>
