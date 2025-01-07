<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";
    import Divider from "../Components/Divider.svelte";

    let form = useForm({
        email: "",
        password: "",
    });

    function submit(e) {
        e.preventDefault();
        $form.post("/login", {
            onSubmit: () => $form.reset("password"),
        });
    }
</script>

<svelte:head>
    <title>Log In</title>
</svelte:head>

<div class="mb-6">
    <form onsubmit={submit}>
        <div class="mb-3">
            <!-- svelte-ignore a11y-autofocus -->
            <input
                type="email"
                bind:value={$form.email}
                placeholder="E-mail"
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
                autofocus
            />
            {#if $form.errors.email}
                <div class="text-red-500 text-xs mt-1">
                    {$form.errors.email}
                </div>
            {/if}
        </div>
        <div class="mb-3">
            <input
                type="password"
                bind:value={$form.password}
                placeholder="Password"
                class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
            />
            {#if $form.errors.password}
                <div class="text-red-500 text-xs mt-1">
                    {$form.errors.password}
                </div>
            {/if}
        </div>
        <button
            type="submit"
            class="p-2 font-semibold border border-zinc-200 rounded-full bg-zinc-200 hover:bg-zinc-100 text-sm text-black/90 w-full"
            disabled={$form.processing}>Log In</button
        >
    </form>
</div>

<Divider text="Sign in or register" />

<div class="flex justify-center">
    <a href="/oauth"
        ><img src="./google-signin.png" alt="[]" class="w-full sm:w-56" /></a
    >
</div>
