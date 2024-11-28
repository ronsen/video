<script>
    import { useForm } from "@inertiajs/svelte";

    import Fa from "svelte-fa";
    import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";

    let { q } = $props();

    let form = useForm({
        q,
    });

    function submit(e) {
        e.preventDefault();
        $form.get("/");
    }
</script>

<div class="relative">
    <form onsubmit={submit}>
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
</div>
