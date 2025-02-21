<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";

    import Fa from "svelte-fa";
    import { faInfoCircle } from "@fortawesome/free-solid-svg-icons";

    let { categories } = $props();

    let form = useForm({
        url: null,
        source: null,
        title: null,
        content: null,
        private: false,
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

<div class="md:max-w-2xl md:mx-auto">
    <form onsubmit={submit}>
        <div class="mb-3">
            <!-- svelte-ignore a11y_autofocus -->
            <input
                type="url"
                bind:value={$form.url}
                onchange={fetchTitle}
                placeholder="URL"
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
                autofocus
            />
            <div class="mt-1 text-xs text-gray-400 flex items-center gap-1">
                <Fa icon={faInfoCircle} />
                <span>Only supports YouTube</span>
            </div>
            {#if $form.errors.url}
                <div class="text-red-500 text-xs mt-1">
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
                <div class="text-red-500 text-xs mt-1">
                    {$form.errors.title}
                </div>
            {/if}
        </div>
        <div class="mb-3">
            <select class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full">
                {#each categories as category}
                    <option value="{category.id}">{category.name}</option>
                {/each}
            </select>
        </div>
        <div class="mb-3">
            <textarea
                bind:value={$form.content}
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full h-40"
            ></textarea>
        </div>
        <div class="mb-3">
            <label class="flex justify-start items-center gap-2">
                <input
                    type="checkbox"
                    bind:checked={$form.private}
                    class="border border-zinc-600 rounded bg-zinc-800 text-white/90"
                />Private
            </label>
        </div>
        <button
            type="submit"
            class="p-2 font-semibold border border-zinc-200 rounded-full bg-zinc-200 hover:bg-zinc-100 text-sm text-black/90 w-full"
            disabled={$form.processing}>Save</button
        >
    </form>
</div>
