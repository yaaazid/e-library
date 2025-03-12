<div class="flex justify-between items-center p-4 shadow">
    <!-- logo -->
     <div class="font-bold text-2xl hover:text-blue-900">
        E-LIBRARY
     </div>

    <!-- Navigation -->
     <nav class="flex gap-2 items-center">
        @auth
        <span>{{ auth()->user()->name }}</span>
        <!-- <a href="#" class="hover:text-blue-900">Logout</a> -->
         <form action={{ route('logout') }} method="POST">
            @csrf
            <button type="submit" class="hover:text-blue-900">Logout</button>
         </form>
        @else
        <a href={{route('sign-in-form')}} class="hover:text-blue-900">Sign In</a>
        <a href={{route('sign-up-form')}} class="hover:text-blue-900">Sign Up</a>
        @endauth
     </nav>
</div>