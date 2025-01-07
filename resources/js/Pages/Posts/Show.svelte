<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { page, Link } from "@inertiajs/svelte";
    import Delete from "../Components/Delete.svelte";

    import Fa from "svelte-fa";
    import {
        faPencilAlt,
        faPlayCircle,
        faLink,
		faArrowUpRightFromSquare,
    } from "@fortawesome/free-solid-svg-icons";

    let { post } = $props();

    let video;

    function play() {
        video.innerHTML = post.video_html;
    }
</script>

<svelte:head>
    <title>{post.title}</title>
</svelte:head>

<article>
    <div bind:this={video} class="relative mb-4">
        <img
            src={post.thumbnail_url}
            alt={post.title}
            class="w-full rounded-lg"
        />

        <button
            onclick={play}
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-red-500 hover:text-red-600"
        >
            <Fa icon={faPlayCircle} size="4x" />
        </button>
    </div>

    <div
        class="flex justify-between items-center border-b border-zinc-500 pb-3 mb-3"
    >
        <div class="title font-bold">{post.title}</div>

        {#if $page.props.auth.user}
            <div class="inline-flex items-center gap-3">
                <a
                    href={post.url}
                    class="text-zinc-400 hover:text-zinc-300"
                    target="_blank"><Fa icon={faArrowUpRightFromSquare} /></a
                >
                <Link
                    href="/posts/{post.id}/edit"
                    class="text-zinc-400 hover:text-zinc-300"
                    ><Fa icon={faPencilAlt} /></Link
                >
                <Delete {post} />
            </div>
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
</article>
