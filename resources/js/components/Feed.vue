<template>
    <div>
        <h2>Feeds</h2>

        <div class="flex">
            <input v-model="search" placeholder="Search" />
        </div>
        <div class="flex">
            <input v-model="category" placeholder="Filter by category" />
        </div>
        <div class="card card-body" v-for="feed in feeds" v-bind:key="feed.id">
            <h3 v-on:click="openFeed(feed.id)" v-html="feed.title">
                {{ feed.title }}
            </h3>
            <div v-if="show.indexOf(feed.id) != -1">
                <div>Media:</div>
                <div v-for="media in feed.medias" v-bind:key="media.id">
                    <img
                        :src="JSON.parse(media.media).attributes.url"
                        :style="{
                            width:
                                JSON.parse(media.media).attributes.width + 'px',
                            height:
                                JSON.parse(media.media).attributes.height +
                                'px',
                        }"
                    />
                </div>
                <p v-html="JSON.parse(feed.content)[0].content"></p>
            </div>
            <div>
                Primary Category:
                {{
                    JSON.parse(feed.categories).primary
                        ? JSON.parse(feed.categories).primary
                        : JSON.parse(feed.categories).additional[0]
                }}
            </div>
            <div>
                Additional Category:
                {{ JSON.parse(feed.categories).additional.toString() }}

            </div>
        </div>
        <div v-if="!!!feeds.length">
            Not Found Feeds!
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            feeds: [],
            feed: {
                id: "",
                title: "",
                slug: "",
                content: "",
                categories: "",
                status: "",
                published: "",
                modified: "",
                medias: [],
            },
            search: "",
            category: "",
            show: [],
            media: {
                id: "",
                type: "",
                media: "",
            },
        };
    },

    mounted() {
        this.getFeeds();
    },
    methods: {
        loadData() {
            this.getFeeds(this.search, this.category);
        },
        getFeeds(search = "", category = "") {
            axios.post("api/feeds", { search, category }).then((res) => {
                this.feeds = res.data;

                console.log(res.data);
            });
        },
        openFeed(id) {
            const index = this.show.indexOf(id);
            if (index > -1) {
                console.log(this.show);
                this.show.splice(index, 1);
            } else {
                this.show.push(id);
            }
        },
    },
    watch: {
        search(val) {
            this.loadData();
        },
        category(val) {
            this.loadData();
        },
    },
};
</script>
