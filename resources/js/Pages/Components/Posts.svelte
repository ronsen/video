<script>
    import { page, Link } from "@inertiajs/svelte";
    import Alert from "../Components/Alert.svelte";
    import Delete from "../Components/Delete.svelte";
    import Pagination from "../Components/Pagination.svelte";

    import Fa from "svelte-fa";
    import { faPencilAlt } from "@fortawesome/free-solid-svg-icons";

    let { posts } = $props();
</script>

{#if posts.data.length == 0}
    <Alert>Empty.</Alert>
{:else}
    {#each posts.data as post}
        <div
            class="flex justify-between items-center border-b border-zinc-600 gap-3 pb-2 mb-2"
        >
            <Link href="/v/{post.id}/{post.slug}">{post.title}</Link>

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
