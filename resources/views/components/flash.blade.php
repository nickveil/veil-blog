@if (session()->has('success'))
    <div    x-data="{show:true}"
            x-init="setTimeout(()=> show = false, 4000)"
            x-show="show"
            class="fixed bottom-3 right-3 bg-green-100 border border-green-300 p-6 rounded-xl text-green-500"
    >
            <p class="text-green-500 ">{{ session('success') }}</p>
    </div>
@endif