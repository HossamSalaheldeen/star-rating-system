<form id="create-user-form" class="form_content mt-3" method="POST" action="{{route('settings.users.store')}}">
    <div class="container-fluid p-0">
        <div class="row">
          @include('settings.users.fields')
        </div>
    </div>
</form>
