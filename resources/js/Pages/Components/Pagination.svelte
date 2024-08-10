<script>
    import { faArrowLeft, faArrowRight } from "@fortawesome/free-solid-svg-icons";
    import { Link } from "@inertiajs/svelte";
	
	import Fa from "svelte-fa";
    
    export let data;
</script>

<div class="mt-6">
    <div class="flex justify-between gap-4">
        {#if data.prev_page_url}
            <Link href={data.prev_page_url}><Fa icon={faArrowLeft} /></Link>
        {:else}
            <button class="btn-disabled text-base-300"><Fa icon={faArrowLeft} /></button>
        {/if}

        {#if data.next_page_url}
            <Link href={data.next_page_url}><Fa icon={faArrowRight} /></Link>
        {:else}
            <button class="btn-disabled text-base-300"><Fa icon={faArrowRight} /></button>
        {/if}
    </div>
</div>