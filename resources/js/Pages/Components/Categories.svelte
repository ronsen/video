<script>
    import { Link } from "@inertiajs/svelte";
    import { House } from "lucide-svelte";

    let { categories } = $props();
</script>

<div class="overflow-x-auto mb-4">
    <ul class="inline-flex items-center gap-4 mb-2">
        <li><Link href="/"><House size={16} /></Link></li>
        {#each categories as category}
            <li>
                <Link href="/category/{category.slug}" class="text-nowrap"
                    >{category.name}</Link
                >
            </li>
        {/each}
    </ul>
</div>
