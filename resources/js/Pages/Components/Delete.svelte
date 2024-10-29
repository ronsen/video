<script>
    import { useForm } from "@inertiajs/svelte";

    import Fa from "svelte-fa";
    import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";

    export let post;

    let dialog;
    let form = useForm();

    function destroy() {
        dialog.showModal();
    }

    function submit() {
        $form.delete(`/posts/${post.id}`);
        dialog.close();
    }
</script>

<button class="text-base-300" on:click={() => destroy()}
    ><Fa icon={faTrashAlt} /></button
>

<dialog
    bind:this={dialog}
    class="bg-zinc-800 text-white/90 p-6 w-full shadow-lg rounded-lg"
>
    <form on:submit|preventDefault={submit}>
        <h3 class="font-bold">Delete this video?</h3>
        <p class="py-4">{post.title}</p>

        <div class="inline-flex items-center gap-1">
            <button
                class="p-2 border border-zinc-500 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90 w-full"
                on:click|preventDefault={() => dialog.close()}>No</button
            >
            <button
                type="submit"
                class="p-2 border border-red-500 rounded-lg bg-red-800 hover:bg-red-700 text-sm text-white/90 w-full"
                >Yes</button
            >
        </div>
    </form>
</dialog>
