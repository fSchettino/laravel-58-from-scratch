<div class="form-group">
    <label for="name">Name</label>
    <input type="name" class="form-control" id="name" name="name" value="{{ old('name') ?? $customer->name }}">
    <small id="nameValidationMsg">{{ $errors->first('name') }}</small>
</div>

<div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? $customer->email }}">
    <small id="emailValidationMsg">{{ $errors->first('email') }}</small>
</div>
<div class="form-group">
    <label for="active">Status</label>
    <select id="active" name="active" class="form-control">
        <option value="">Select customer status</option>
        @foreach($customer->activeOptions() as $activeOptionKey => $activeOptionValue)
            <option value="{{ $activeOptionKey }}" {{ $customer->active == $activeOptionValue ? 'selected' : '' }}>{{ $activeOptionValue }}</option>
        @endforeach
    </select>
    <small id="activeValidationMsg">{{ $errors->first('active') }}</small>
</div>
<div class="form-group">
    <label for="company_id">Company</label>
    <select id="company_id" name="company_id" class="form-control">
        <option value="">Select company</option>
        @foreach($companiesList as $company)
            <option value="{{ $company->id }}" {{ $company->id == $customer->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
        @endforeach
    </select>
    <small id="companyValidationMsg">{{ $errors->first('company_id') }}</small>
</div>
<div class="form-group d-flex flex-column pb-2">
    <label for="image">Profile image</label>
    <input type="file" id="image" name="image" class="pb-1">
    <small id="imageValidationMsg">{{ $errors->first('image') }}</small>
</div>
@csrf
