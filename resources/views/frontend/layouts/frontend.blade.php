<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts.partials.head._head')

<body>

    @livewire('navigation')

    <!-- Main Content -->
    <div class="main">
        @yield('content')
    </div>
    <!-- Main Content -->

    @include('frontend.layouts.partials.footer._footer')


    @include('frontend.layouts.partials.script._scripts')

</body>

</html>