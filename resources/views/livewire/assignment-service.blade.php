
    <form method="post" action="{{route('storeservice')}}" enctype="multipart/form-data">
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
                    <strong>Žymos:</strong>
                    @foreach($tags as $tag)
                        <input class="single-checkbox" name="tags[]" type="checkbox" wire:model="selectedTag" value="{{$tag->id}}"<?php if(count($selectedTag) >= 3){ ?> onclick="return false;" <?php } ?>>  {{$tag->name}}
                    @endforeach
                </div>
            @endif
            <label class="label">Skelbimo pavadinimas: </label>
            <input placeholder="Skelbimo pavadinimas" type="text" name="name" class="form-control" required/>
        </div>
        <div class="form-group">
            <label class="label">Skelbimo kaina: </label>
            <input placeholder="Skelbimo kaina" type="number" name="price" class="form-control" required/>
        </div>
        <div class="form-group">
            <label class="label">Informacija: </label>
            <input placeholder="Informacija apie paslaugas" type="text" name="info" class="form-control" required/>
        </div>

        <div class="form-group">
            <input <?php if(count($selectedTag) <= 2){?> disabled <?php } ?>   type="submit" class="btn btn-success" />
            <a href="{{ route('personalAnn') }}" class="btn btn-primary">Atgal</a>
        </div>

    </form>
