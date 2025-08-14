<script lang="ts">
	import { Link } from "@inertiajs/svelte";
	import App from "../Layouts/App.svelte";
	import Posts from "../Components/Posts.svelte";
	import type { Post, User } from "@/types";

	interface Props {
		posts: {
			data: Post[];
			prev_page_url: string;
			next_page_url: string;
		};
		user: User;
	}

	let { posts, user }: Props = $props();
</script>

<svelte:head>
	<title>{user.name}</title>
</svelte:head>

<App>
	<div class="my-4 px-6">
		<h3 class="font-bold mb-6 border-b border-zinc-600 gap-3 pb-2">
			<Link href="/user/{user.id}/{user.slug}">{user.name}</Link>
		</h3>

		<Posts {posts} showUser={true} />
	</div>
</App>
