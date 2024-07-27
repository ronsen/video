<script>
    import { useForm } from "@inertiajs/svelte";
    import App from "../Layouts/App.svelte";

    let form = useForm({
		url: null,
		source: null,
        title: null,
        content: null
    });

    function submit() {
        $form.post('/posts');
    }

	async function fetchTitle() {
		try {
			if (!form.title) {
				const { title } = await fetch('/api/title?url=' + $form.url)
					.then(response => {
						return response.json();
					});

				$form.title = title;
			}
		} catch (error) {
			console.error('Error fetching the title:', error);
		}
	}
</script>

<svelte:head>
    <title>Add New Video</title>
</svelte:head>

<App>
    <form on:submit|preventDefault={submit}>
		<div class="mb-3">
            <!-- svelte-ignore a11y-autofocus -->
            <input
				type="url"
				bind:value={$form.url}
				on:change={fetchTitle}
				placeholder="URL"
				class="input input-bordered w-full"
				autofocus>
            {#if $form.errors.url}
                <div class="text-error text-sm font-bold mt-1">{$form.errors.url}</div>
            {/if}
        </div>
        <div class="mb-3">
            <input type="text" bind:value={$form.title} placeholder="Title" class="input input-bordered w-full">
            {#if $form.errors.title}
                <div class="text-error text-sm font-bold mt-1">{$form.errors.title}</div>
            {/if}
        </div>
        <div class="mb-3">
            <textarea bind:value={$form.content} rows="5" class="textarea textarea-bordered w-full" />
        </div>
        <button type="submit" class="btn btn-primary" disabled={$form.processing}>Save</button>
    </form>
</App>
