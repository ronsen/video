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

<section class="relative mb-6">
    <form on:submit|preventDefault={submit}>
        <div class="inline-flex w-full">
            <input
                type="search"
                bind:value={$form.q}
                class="border border-zinc-600 bg-zinc-800 rounded-lg text-white/90 w-full"
                required
            />
            <button
                type="submit"
                disabled={$form.processing}
                class="absolute p-3.5 top-0 right-0 text-sm text-white/90 hover:text-white"
                ><Fa icon={faMagnifyingGlass} /></button
            >
        </div>
    </form>
</section>

{#if posts.data.length == 0}
    <Alert>Empty.</Alert>
{:else}
    {#each posts.data as post}
        <div
            class="flex justify-between items-center border-b border-zinc-600 gap-3 pb-2 mb-2"
        >
            <Link href="/{post.id}/{post.slug}">{post.title}</Link>

            {#if $page.props.auth.user}
                <div class="inline-flex gap-3">
                    <Link
                        href="/posts/{post.id}/edit"
                        class="text-zinc-400 hover:text-zinc-300"
                        ><Fa icon={faPencilAlt} /></Link
                    >
                    <Delete {post} />
                </div>
            {/if}
        </div>
    {/each}

    <Pagination data={posts} />
{/if}
