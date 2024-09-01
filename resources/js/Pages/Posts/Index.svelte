<script context="module">
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { page, Link, useForm } from "@inertiajs/svelte";
    import Alert from "../Components/Alert.svelte";
    import Pagination from "../Components/Pagination.svelte";
    import Delete from "../Components/Delete.svelte";

    import Fa from "svelte-fa";
    import {
        faMagnifyingGlass,
        faPencilAlt,
    } from "@fortawesome/free-solid-svg-icons";

    export let posts;
    export let q;

    let form = useForm({
        q,
    });

    function submit() {
        $form.get("/");
    }
</script>

<svelte:head>
    <title>{$page.props.appName}</title>
</svelte:head>

<div class="mb-6">
    <form on:submit|preventDefault={submit}>
        <div class="join w-full">
            <input
                type="search"
                bind:value={$form.q}
                class="input input-bordered w-full join-item"
                required
            />
            <button
                type="submit"
                disabled={$form.processing}
                class="btn btn-primary join-item"
                ><Fa icon={faMagnifyingGlass} /></button
            >
        </div>
    </form>
</div>

{#if posts.data.length == 0}
    <Alert>Empty.</Alert>
{:else}
    {#each posts.data as post}
        <div
            class="flex justify-between items-center border-b border-base-300 pb-2 mb-2"
        >
            <Link href="/v/{post.id}/{post.slug}">{post.title}</Link>

            {#if $page.props.auth.user}
                <div class="inline-flex gap-3">
                    <Link href="/posts/{post.id}/edit" class="text-base-300"
                        ><Fa icon={faPencilAlt} /></Link
                    >
                    <Delete {post} />
                </div>
            {/if}
        </div>
    {/each}

    <Pagination data={posts} />
{/if}
