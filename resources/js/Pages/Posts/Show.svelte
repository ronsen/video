<script module>
	export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
	import { page, Link } from "@inertiajs/svelte";
	import { CirclePlay, ExternalLink, Lock, Pencil } from "@lucide/svelte";
	import Delete from "../Components/Delete.svelte";

	let { post, owner } = $props();

	let video;

	function play() {
		video.innerHTML = post.video_html;
	}
</script>

<svelte:head>
	<title>{post.title}</title>
</svelte:head>

<article class="md:max-w-2xl md:mx-auto">
	<div class="m-0 md:my-4">
		<div bind:this={video} class="relative mb-4">
			<img
				src={post.high_thumbnail_url}
				alt={post.title}
				class="w-full"
			/>

			<button
				onclick={play}
				class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-red-500 hover:text-red-600"
			>
				<CirclePlay size={96} />
			</button>
		</div>
	</div>

	<div class="my-4 px-6 md:m-0 md:p-0">
		<div
			class="flex justify-between items-baseline border-b border-zinc-500 gap-3 pb-3 mb-3"
		>
			<div>
				<div class="inline-flex items-baseline gap-2 text-lg font-bold">
					{#if post.private}
						<Lock size={16} />
					{/if}
					<div>{post.title}</div>
				</div>
				<div class="text-sm">
					<Link href="/user/{post.user.id}/{post.user.slug}"
						>{post.user.name}</Link
					>
				</div>
			</div>

			{#if $page.props.auth.user}
				{#if owner}
					<div class="inline-flex items-center gap-3">
						<a
							href={post.url}
							class="text-zinc-400 hover:text-zinc-300"
							target="_blank"><ExternalLink size={16} /></a
						>
						<Link
							href="/posts/{post.id}/edit"
							class="text-zinc-400 hover:text-zinc-300"
							><Pencil size={16} /></Link
						>
						<Delete {post} />
					</div>
				{/if}
			{/if}
		</div>

		<div class="content max-w-none mb-3">
			{@html post.content_to_html}
		</div>

		{#if post.tags}
			<div class="flex justify-center text-sm gap-4">
				{#each post.tags as tag}
					<div class="rounded-lg px-2 py-1 bg-zinc-800">
						<a href="/tag/{tag.slug}">{tag.name}</a>
					</div>
				{/each}
			</div>
		{/if}
	</div>
</article>
