...<form method="POST" action="/ducks" novalidate>
    <div class="form-group @if ($errors->has('name')) has-error @endif">
        <label for="name">Namelabel>
            <input type="text" id="name" class="form-control" name="name" placeholder="Somebody Awesome" value="{{ Input::old('name') }}"> @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}p> @endif div>
            <div class="form-group @if ($errors->has('email')) has-error @endif"> <label for="email">Emaillabel> <input type="text" id="email" class="form-control" name="email" placeholder="super&64;cool.com" value="{{ Input::old('email') }}"> @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}p> @endif div>..