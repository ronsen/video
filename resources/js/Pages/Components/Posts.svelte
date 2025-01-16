<script>
    import { Link } from "@inertiajs/svelte";
    import Alert from "../Components/Alert.svelte";
    import Pagination from "../Components/Pagination.svelte";

    let { posts } = $props();
</script>

{#if posts.data.length == 0}
    <Alert>Empty.</Alert>
{:else}
    <div class="grid md:grid-cols-3 gap-4">
        {#each posts.data as post}
            <div>
                <Link href="/v/{post.id}/{post.slug}"
                    ><img
                        src={post.thumbnail_url}
                        alt={post.title}
                        class="w-full rounded-lg object-cover"
                    />
                </Link>
                <div class="mt-1">
                    <Link href="/v/{post.id}/{post.slug}">{post.title}</Link>
                </div>
            </div>
        {/each}
    </div>

    <Pagination data={posts} />
{/if}
