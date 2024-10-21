<script context="module">
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
    } from "@fortawesome/free-solid-svg-icons";

    export let post;

    let video;

    function play() {
        video.innerHTML = post.video_html;
    }
</script>

<svelte:head>
    <title>{post.title}</title>
</svelte:head>

<article>
    <div bind:this={video} class="relative mb-3">
        <img
            src={post.thumbnail_url}
            alt={post.title}
            class="w-full rounded-lg"
        />

        <button
            on:click={play}
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-red-500 hover:text-red-600"
        >
            <Fa icon={faPlayCircle} size="4x" />
        </button>
    </div>

    <div
        class="flex justify-between items-center border-b border-base-300 pb-3 mb-3"
    >
        <div class="title font-bold">{post.title}</div>

        {#if $page.props.auth.user}
            <div class="inline-flex items-center gap-3">
				<a href="{post.url}" class="text-base-300" target="_blank"><Fa icon={faLink} /></a>
                <Link href="/posts/{post.id}/edit" class="text-base-300"
                    ><Fa icon={faPencilAlt} /></Link
                >
                <Delete {post} />
            </div>
        {/if}
    </div>

    <div class="content max-w-none mb-3">
        {@html post.content_to_html}
    </div>
</article>
