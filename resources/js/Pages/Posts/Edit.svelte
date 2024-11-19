<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";

    let { post } = $props();

    let form = useForm({
        url: post.url,
        title: post.title,
        content: post.content,
    });

    function submit(e) {
        e.preventDefault();
        $form.patch("/posts/" + post.id);
    }
</script>

<svelte:head>
    <title>Edit Video</title>
</svelte:head>

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
            rows="5"
            class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full h-96"
        ></textarea>
    </div>
    <button
        type="submit"
        class="p-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90 w-full"
        disabled={$form.processing}>Save</button
    >
</form>
