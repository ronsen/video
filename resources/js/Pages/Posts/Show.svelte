<script>
    import { page, Link, useForm } from "@inertiajs/svelte";
    import App from "../Layouts/App.svelte";

	import Fa from "svelte-fa";
    import { faPencilAlt, faPlayCircle, faTrashAlt } from "@fortawesome/free-solid-svg-icons";

    export let post;
    let dialog;
	let video;
    let form = useForm();

    function destroy() {
        dialog.showModal();
    }

    function submit() {
        $form.delete(`/posts/${post.id}`);
    }

	function play() {
		video.innerHTML = post.video_html;
	}
</script>

<svelte:head>
    <title>{post.title}</title>
</svelte:head>

<App>
    <article>
		<div bind:this={video} class="relative mb-3">
			<img src="{post.thumbnail_url}" alt="{post.title}" class="w-full rounded-lg">

			<button 
				on:click={play}
				class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-red-500 hover:text-red-600">
				<Fa icon={faPlayCircle} size="4x" />
			</button>
		</div>

        <div class="flex justify-between items-center border-b border-base-300 pb-3 mb-3">
            <div class="title font-bold">{post.title}</div>

            {#if $page.props.auth.user}
                <div class="inline-flex items-center gap-3">
                    <Link href="/posts/{post.id}/edit" title="Edit Post" class="text-gray-500"><Fa icon={faPencilAlt} /></Link>
                    <button title="Delete Post" class="text-gray-500" on:click={() => destroy()}><Fa icon={faTrashAlt} /></button>
                </div>
            {/if}
        </div>
    
        <div class="content max-w-none mb-3">
            {@html post.content_to_html}
        </div>
    </article>
</App>

<dialog bind:this={dialog} class="modal">
    <form on:submit|preventDefault={submit} class="modal-box">
        <h3 class="font-bold text-lg">Confirm</h3>
        <p class="py-4">Delete this video?</p>

        <div class="modal-action">
            <button class="btn btn-neutral btn-sm" on:click|preventDefault={() => dialog.close()}>No</button>
            <button type="submit" class="btn btn-error btn-sm">Yes</button>
        </div>
    </form>
</dialog>