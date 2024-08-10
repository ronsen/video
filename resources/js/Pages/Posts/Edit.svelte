<script>
    import { useForm } from "@inertiajs/svelte";
    import App from "../Layouts/App.svelte";

    export let post;

    let form = useForm({
        url: post.url,
        title: post.title,
        content: post.content,
    });

    function submit() {
        $form.patch("/posts/" + post.id);
    }
</script>

<svelte:head>
    <title>Edit Video</title>
</svelte:head>

<App>
    <form on:submit|preventDefault={submit}>
        <div class="mb-3">
            <!-- svelte-ignore a11y-autofocus -->
            <input
                type="url"
                bind:value={$form.url}
                placeholder="URL"
                class="input input-bordered w-full"
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
                class="input input-bordered w-full"
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
                class="textarea textarea-bordered w-full"
            />
        </div>
        <button
            type="submit"
            class="btn btn-primary"
            disabled={$form.processing}>Save</button
        >
    </form>
</App>
