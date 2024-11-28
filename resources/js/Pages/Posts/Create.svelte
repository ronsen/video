<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";

    let form = useForm({
        url: null,
        source: null,
        title: null,
        content: null,
		tags: null,
    });

    function submit(e) {
        e.preventDefault();
        $form.post("/posts");
    }

    async function fetchTitle() {
        try {
            if (!form.title) {
                const { title } = await fetch(
                    "/api/title?url=" + $form.url,
                ).then((response) => {
                    return response.json();
                });

                $form.title = title;
            }
        } catch (error) {
            console.error("Error fetching the title:", error);
        }
    }
</script>

<svelte:head>
    <title>Add New Video</title>
</svelte:head>

<form on:submit={submit}>
    <div class="mb-3">
        <!-- svelte-ignore a11y-autofocus -->
        <input
            type="url"
            bind:value={$form.url}
            on:change={fetchTitle}
            placeholder="URL"
            class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
            autofocus
        />
        {#if $form.errors.url}
            <div class="text-error text-sm mt-1">
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
            <div class="text-error text-sm mt-1">
                {$form.errors.title}
            </div>
        {/if}
    </div>
    <div class="mb-3">
        <textarea
            bind:value={$form.content}
            rows="5"
            class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
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
        class="p-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90 w-full"
        disabled={$form.processing}>Save</button
    >
</form>
