<nav class="fixed top-0 left-0 w-screen z-10 shadow-sm shadow-white/40 border-b border-b-black/30 flex items-center flex-shrink-0 h-16 px-10 bg-gray-900">
   <h1 class="title text-xl sm:text-3xl font-lifeSaver font-black text-white">
      TaskFlow
   </h1>
   <div class="ml-auto flex items-center gap-6">
      <a class="font-semibold  text-white hover:underline <?= checkURL("/") || checkURL("/home") ? "underline" : "" ?>" href="/">home</a>
      <?php if (User::isLoggedIn()) : ?>
         <a class="font-semibold text-white hover:underline <?= checkURL("/signup") ? "underline" : "" ?>" href="/logout">logout</a>
      <?php else: ?>
         <a class="font-semibold text-white hover:underline <?= checkURL("/signup") ? "underline" : "" ?>" href="/signup">signup</a>
         <a class="font-semibold text-white hover:underline <?= checkURL("/login") ? "underline" : "" ?>" href="/login">login</a>
      <?php endif ?>
      <a href="/profile" class="ml-6 flex items-center justify-center w-8 h-8 overflow-hidden rounded-full cursor-pointer">
         <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8PyKYrBKAWWy6YCbQzWQcwIRqH8wYMPluIZiMpV1w0NYSbocTZz0ICWFkLcXhaMyvCwQ&usqp=CAU" alt="">
      </a>
   </div>
</nav>