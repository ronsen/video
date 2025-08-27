<script lang="ts">
	import type { Category, Post } from "@/types";
	import App from "@/layouts/App.svelte";
	import Posts from "@/components/Posts.svelte";

	interface Props {
		posts: {
			data: Post[];
			prev_page_url: string;
			next_page_url: string;
		};
		categories: Category[];
	}

	let { posts, categories }: Props = $props();
</script>

<svelte:head>
	<title>Social Video Bookmarking</title>
</svelte:head>

<App {categories}>
	<div class="my-4 px-6">
		<Posts {posts} showUser={true} />
	</div>
</App>
