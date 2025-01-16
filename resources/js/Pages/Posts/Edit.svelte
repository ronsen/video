<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";

	import Fa from "svelte-fa";
    import { faInfoCircle } from "@fortawesome/free-solid-svg-icons";

    let { post } = $props();

    let form = useForm({
        url: post.url,
        title: post.title,
        content: post.content,
        tags: post.tags_as_csv,
    });

    function submit(e) {
        e.preventDefault();
        $form.patch("/posts/" + post.id);
    }
</script>

<svelte:head>
    <title>Edit Video</title>
</svelte:head>

<div class="md:max-w-2xl md:mx-auto">
    <form onsubmit={submit}>
        <div class="mb-3">
            <!-- svelte-ignore a11y_autofocus -->
            <input
                type="url"
                bind:value={$form.url}
                placeholder="URL"
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
                autofocus
            />
            <div class="mt-1 text-xs text-gray-400 flex items-center gap-1">
                <Fa icon={faInfoCircle} />
				<span>Only supports YouTube</span>
            </div>
            {#if $form.errors.url}
                <div class="text-error text-sm font-bold mt-1">
                    {$form.errors.url}
                </div>
            {/if}
        </div>
        <div class="mb-3">
            <input
                type="text"
                bind:value={$form.title}
                placeholder="Title"
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
            />
            {#if $form.errors.title}
                <div class="text-error font-bold text-sm mt-1">
                    {$form.errors.title}
                </div>
            {/if}
        </div>
        <div class="mb-3">
            <textarea
                bind:value={$form.content}
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full h-40"
            ></textarea>
        </div>
        <div class="mb-3">
            <input
                type="text"
                bind:value={$form.tags}
                placeholder="Tags (comma seperated)"
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
            />
        </div>
        <button
            type="submit"
            class="p-2 font-semibold border border-zinc-200 rounded-full bg-zinc-200 hover:bg-zinc-100 text-sm text-black/90 w-full"
            disabled={$form.processing}>Update</button
        >
    </form>
</div>
