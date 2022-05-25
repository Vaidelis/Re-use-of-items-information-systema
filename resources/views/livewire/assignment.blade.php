<form method="post" action="{{route('storeitem')}}" enctype="multipart/form-data">
    <div class="form-group">
        @csrf
    <div>
        <strong>Kategorija</strong>
        <select name="kategorija" class="form-control" wire:model="selectedClass">
            <option value="">Pasirinkite kategorija</option>
            @foreach($classes as $categor)
                <option name="category" value="{{$categor->id}}">{{$categor->name}}</option>
            @endforeach
        </select>
    </div>
    <br>
    @if(!is_null($tags))
    <div class="form-group">
        <strong>Pinterest segtukai:</strong>

        <div class="rows">
            @foreach($tags as $tag)
               <div> <input class="single-checkbox" name="tags[]" type="checkbox" wire:model="selectedTag" value="{{$tag->id}}"<?php if(count($selectedTag) >= 3){ ?> onclick="return false;" <?php } ?>>  {{$tag->namelt}}</div>
            @endforeach
        </div>
    </div>
    @endif
    <label class="label">Skelbimo pavadinimas: </label>
    <input style="padding-left:12px" placeholder="Skelbimo pavadinimas" type="text" name="name" class="form-control" required/>
</div>
        <div class="form-group">
            <label class="label">Skelbimo kaina: </label>
            <input placeholder="Skelbimo kaina" type="number" name="price" class="form-control" required/>
        </div>
        <div class="form-group">
            <label class="label">Adresas: </label>
            <input style="padding-left:12px" placeholder="Adresas"  type="text" name="address" class="form-control" required/>
        </div>
        <div class="form-group">
            <label class="label">Informacija: </label>
            <textarea rows="4" cols="50" style="height:120px; vertical-align: top" name="info" class="form-control" required></textarea>
        </div>
    <div class="form-group">
        <strong>Ar domina keitimosi pasiūlymai?:</strong>
            <input class="single-checkbox" name="change" type="checkbox"  value="1">
    </div>

        <div class="form-group">
            <label>
            <img style="height: 50px; width: 50px" src="/img/picture.svg.png">
            <input id="file-input" type="file" style="display: none" name="images[]" multiple class="file" data-overwrite-initial="false" accept="image/*" required>
            @if ($errors->has('files'))
                @foreach ($errors->get('files') as $error)
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $error }}</strong>
                                     </span>
                @endforeach
            @endif
            </label>
            <div id="preview"></div>
        </div>
        <div class="form-group">
            <input <?php if(count($selectedTag) <= 2){?> disabled <?php } ?> type="submit" value="Įkelti" class="btn btn-success" />
            <a href="{{ route('personalAnn') }}" class="btn btn-primary">Atgal</a>
        </div>
</form>
<style>
    #preview img { max-height: 100px; }
</style>
<script>
    const EL_browse  = document.getElementById('file-input');
    const EL_preview = document.getElementById('preview');

    const readImage  = file => {
        if ( !(/^image\/(png|jpe?g|gif)$/).test(file.type) )
            return EL_preview.insertAdjacentHTML('beforeend', `Unsupported format ${file.type}: ${file.name}<br>`);

        const img = new Image();
        img.addEventListener('load', () => {
            EL_preview.appendChild(img);
            window.URL.revokeObjectURL(img.src); // Free some memory
        });
        img.src = window.URL.createObjectURL(file);
    }

    EL_browse.addEventListener('change', ev => {
        EL_preview.innerHTML = ''; // Remove old images and data
        const files = ev.target.files;
        if (!files || !files[0]) return alert('File upload not supported');
        [...files].forEach( readImage );
    });
</script>




