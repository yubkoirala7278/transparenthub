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

@section('customJS')
    <script src="{{ asset('frontend/js/palika.js') }}"></script>

    <script>
        window.onload = function() {
            var pradeshSel = document.getElementById("pradesh");
            var districtSel = document.getElementById("district");
            var rowContainer = document.querySelector('.palike-box');

            // Populate Pradesh dropdown
            for (var x in palikaObject) {
                pradeshSel.options[pradeshSel.options.length] = new Option(x, x);
            }

            // Event listener for Pradesh selection change
            pradeshSel.addEventListener('change', function() {
                districtSel.length = 1; // Reset districts dropdown
                for (var y in palikaObject[this.value]) {
                    districtSel.options[districtSel.options.length] = new Option(y, y);
                }

                // Automatically trigger the district selection change
                if (districtSel.options.length > 1) {
                    districtSel.selectedIndex = 1;
                    districtSel.dispatchEvent(new Event('change'));
                }
            });

            // Event listener for District selection change
            districtSel.addEventListener('change', function() {
                rowContainer.innerHTML = ''; // Clear previous entries
                var z = palikaObject[pradeshSel.value][this.value];
                for (var i = 0; i < z.length; i++) {
                    var box = document.createElement('div');
                    box.className = 'box';

                    var pname = document.createElement('h3');
                    pname.className = 'palika-name';
                    pname.textContent = z[i];

                    var population = document.createElement('span');
                    population.className = 'population';
                    population.textContent = "Population: 19800";

                    var area = document.createElement('span');
                    area.className = 'area';
                    area.textContent = "Area: 19800 sq.ft";

                    var readBtn = document.createElement('a');
                    readBtn.className = 'palika-read-more btn btn-sm btn-danger';
                    readBtn.href = "{{ route('palika-detail') }}";
                    readBtn.textContent = "Read More";

                    box.appendChild(pname);
                    box.appendChild(population);
                    box.appendChild(area);
                    box.appendChild(readBtn);
                    rowContainer.appendChild(box);
                }
            });

            // Set the first Pradesh as selected and trigger change event programmatically
            if (pradeshSel.options.length > 1) {
                pradeshSel.selectedIndex = 1;
                pradeshSel.dispatchEvent(new Event('change'));
            }
        };
    </script>

    {{-- <script>
        window.onload = function() {
            var pradeshSel = document.getElementById("pradesh");
            var districtSel = document.getElementById("district");
            // var municipalitySel = document.getElementById("municipality");
            for (var x in palikaObject) {
                pradeshSel.options[pradeshSel.options.length] = new Option(x, x);
            }
            pradeshSel.onchange = function() {
                //empty Chapters- and Topics- dropdowns
                // municipalitySel.length = 1;
                districtSel.length = 1;
                //display correct values
                for (var y in palikaObject[this.value]) {
                    districtSel.options[districtSel.options.length] = new Option(y, y);
                }
            }
            districtSel.onchange = function() {
                var rowContainer = document.querySelector('.palike-box');
                rowContainer.innerHTML = '';
                //empty Chapters dropdown
                // municipalitySel.length = 1;
                //display correct values
                var z = palikaObject[pradeshSel.value][this.value];
                for (var i = 0; i < z.length; i++) {
                    // municipalitySel.options[municipalitySel.options.length] = new Option(z[i], z[i]);


                    // Create a new box with a p tag for each municipality
                    var box = document.createElement('div');
                    box.className = 'box';
                    var pname = document.createElement('h3');
                    var population = document.createElement('span');
                    var area = document.createElement('span');

                    var readBtn = document.createElement('a');


                    pname.className = 'palika-name';
                    population.className = 'population';
                    area.className = 'area';
                    readBtn.className = 'palika-read-more btn btn-sm btn-danger';
                    readBtn.href = "{{ route('palika-detail') }}";

                    pname.textContent = z[i];
                    population.textContent = "Population:- 19800";
                    area.textContent = "area:- 19800 sq.fit";
                    readBtn.textContent = "Read More";


                    // Append p tag to box and box to row container
                    box.appendChild(pname);
                    box.appendChild(population);
                    box.appendChild(area);
                    box.appendChild(readBtn);
                    rowContainer.appendChild(box);


                }
            }

        }
    </script> --}}
@endsection
