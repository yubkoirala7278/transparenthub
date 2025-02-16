@extends('frontend.layouts.master')
@section('content')
    <section class="top-add-wrapper mt-0">
        <div class="">
            <img class="top-add-gif" src="{{ asset('frontend/gif/main-2.gif') }}" alt="..." loading="lazy">
        </div>
    </section>

    <section class="container-fluid mt-5">
        <div class="row gy-4">
            <div class="col-md-3 px-0">
                <div class="h-100 palika-select">

                    <div class="my-box">
                        <label for="fname">Pradesh</label>
                        <select class="form-select rounded-0 border-secondary mb-3" name="pradesh" id="pradesh">
                            <option value="" selected="selected">Select Pradesh</option>
                        </select>
                    </div>



                    <div class="my-box">
                        <label for="email">District</label>
                        <select class="form-select rounded-0 border-secondary mb-3" name="district" id="district">
                            <option value="" selected="selected">Please select pradesh first
                            </option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="palike-box">

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('script')
    <script>
        window.onload = function() {
            var pradeshSel = document.getElementById("pradesh");
            var districtSel = document.getElementById("district");
            var rowContainer = document.querySelector('.palike-box');

            // Build our data object dynamically using data from the DB, including slug, population, and area
            var palikaObject = {};
            @foreach ($provinces as $province)
                palikaObject["{{ $province->name }}"] = {};
                @foreach ($province->districts as $district)
                    palikaObject["{{ $province->name }}"]["{{ $district->name }}"] = [];
                    @foreach ($district->palikas as $palika)
                        palikaObject["{{ $province->name }}"]["{{ $district->name }}"].push({
                            name: "{{ $palika->name }}",
                            slug: "{{ $palika->slug }}",
                            population: "{{ $palika->population }}",
                            area: "{{ $palika->total_area }}"
                        });
                    @endforeach
                @endforeach
            @endforeach

            // Create URL template for the palika detail page with a placeholder for the slug.
            var urlTemplate = "{{ route('palika-detail', ['slug' => 'PLACEHOLDER']) }}";

            // Populate Pradesh dropdown using keys from palikaObject
            for (var province in palikaObject) {
                pradeshSel.options[pradeshSel.options.length] = new Option(province, province);
            }

            // Listen for changes in the Pradesh (province) dropdown
            pradeshSel.addEventListener('change', function() {
                // Reset the district dropdown
                districtSel.length = 1;
                // Populate District dropdown using keys from the selected province
                for (var district in palikaObject[this.value]) {
                    districtSel.options[districtSel.options.length] = new Option(district, district);
                }

                // Automatically trigger a district change if there's at least one district
                if (districtSel.options.length > 1) {
                    districtSel.selectedIndex = 1;
                    districtSel.dispatchEvent(new Event('change'));
                }
            });

            // Listen for changes in the District dropdown
            districtSel.addEventListener('change', function() {
                // Clear previous palika entries
                rowContainer.innerHTML = '';
                var palikas = palikaObject[pradeshSel.value][this.value];
                for (var i = 0; i < palikas.length; i++) {
                    var box = document.createElement('div');
                    box.className = 'box';

                    var pname = document.createElement('h3');
                    pname.className = 'palika-name';
                    pname.textContent = palikas[i].name;

                    var population = document.createElement('span');
                    population.className = 'population';
                    population.textContent = "Population: " + palikas[i].population;

                    var area = document.createElement('span');
                    area.className = 'area';
                    area.textContent = "Area: " + palikas[i].area + " sq.km";

                    var readBtn = document.createElement('a');
                    readBtn.className = 'palika-read-more btn btn-sm btn-danger';
                    // Replace the placeholder with the actual slug from the palika
                    readBtn.href = urlTemplate.replace('PLACEHOLDER', palikas[i].slug);
                    readBtn.textContent = "Read More";

                    box.appendChild(pname);
                    box.appendChild(population);
                    box.appendChild(area);
                    box.appendChild(readBtn);
                    rowContainer.appendChild(box);
                }
            });

            // If there is at least one province, trigger the change event for the first one.
            if (pradeshSel.options.length > 1) {
                pradeshSel.selectedIndex = 1;
                pradeshSel.dispatchEvent(new Event('change'));
            }
        };
    </script>
@endpush
