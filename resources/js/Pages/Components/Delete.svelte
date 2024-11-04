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

<button class="text-zinc-400 hover:text-zinc-300" on:click={() => destroy()}
    ><Fa icon={faTrashAlt} /></button
>

<dialog
    bind:this={dialog}
    class="border border-zinc-600 bg-zinc-900 text-white/90 w-full md:w-3/4 shadow rounded-lg backdrop:backdrop-blur"
>
    <form on:submit|preventDefault={submit}>
        <div class="p-4">
            <h3 class="font-bold mb-3">Delete this video?</h3>
            <p>{post.title}</p>
        </div>

        <div class="p-4 bg-zinc-800">
            <div class="flex justify-between gap-4">
                <button
                    class="p-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90"
                    on:click|preventDefault={() => dialog.close()}>No</button
                >
                <button
                    type="submit"
                    class="p-2 border border-zinc-600 rounded-lg bg-white/90 hover:bg-white text-sm text-black/90"
                    >Yes</button
                >
            </div>
        </div>
    </form>
</dialog>
