<!-- Get Components of layout -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Contain Css Styles-->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>وصلة</title>
</head>

<body>

    <!-- Header-->
    @include('components.header')

    <!-- Main Area -->
    <div id="app">

        <main class="fade-container  " style="padding:45px 0">
            <!-- Get Toaster Class to use -->
            @include('sweetalert::alert')

            @yield('content')
            @if ($errors->all())
                @foreach ($errors->all() as $error)
                    <h4>{{ $error }}</h4>
                @endforeach
            @endif

        </main>
    </div>


    <!-- Footer-->
    @include('components.footer')

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Fade Effect Transaction -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fadeContainer = document.querySelector('.fade-container');
            if (fadeContainer) {
                fadeContainer.classList.add('loaded');
            }
        });

        // Handle navigation clicks to reapply the fade effect
        document.addEventListener('click', (e) => {
            if (e.target.tagName === 'A' && e.target.href) {
                const fadeContainer = document.querySelector('.fade-container');
                if (fadeContainer) {
                    fadeContainer.classList.remove('loaded');
                    setTimeout(() => {
                        window.location = e.target.href;
                    }, 250); // Match this to your transition duration
                    e.preventDefault();
                }
            }
        });
    </script>



    <!-- Branchs Scripts -->
    <script>
        // Add event listener to branch cards to show maps
        const branchCards = document.querySelectorAll('.branch-card');

        branchCards.forEach(card => {
            card.addEventListener('click', () => {
                const mapId = card.getAttribute('data-map');
                const maps = document.querySelectorAll('.map-container');
                maps.forEach(map => {
                    map.style.display = 'none'; // Hide all maps
                });

                const activeMap = document.getElementById(`${mapId}-map`);
                if (activeMap) {
                    activeMap.style.display = 'block'; // Show the selected map
                }
            });
        });
    </script>
    <!-- Counter of Statichs -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statNumbers = document.querySelectorAll('.stat-number');

            // Function to animate the count-up
            function animateCountUp(element) {
                const countTo = element.getAttribute('data-count');
                let count = 0;
                const duration = 2000; // Duration of the animation in milliseconds
                const increment = Math.ceil(countTo / duration); // Increment value per frame

                function updateCount() {
                    count += increment;
                    if (count >= countTo) {
                        count = countTo; // Ensure we don't go beyond the final value
                        clearInterval(interval);
                    }
                    element.innerText = count;
                }

                const interval = setInterval(updateCount, 1); // Update every millisecond
            }

            // Trigger animation when the page loads
            statNumbers.forEach(statNumber => {
                animateCountUp(statNumber);
            });
        });
    </script>

    <!-- Ajax code to get governate based on selected city -->
    <script>
        document.getElementById('governate').addEventListener('change', function() {
            const governateId = this.value;
            const citySelect = document.getElementById('city');

            if (!governateId) {
                citySelect.innerHTML = '<option value="" disabled selected>اختر المدينة</option>';
                citySelect.disabled = true;
                return;
            }

            fetch(`/get-cities/${governateId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="" disabled selected>اختر المدينة</option>';
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                    citySelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                    alert('حدث خطأ أثناء تحميل المدن.');
                });
        });
    </script>

    <script>
        document.getElementById('governateReciver').addEventListener('change', function() {
            const governateId = this.value;
            const citySelect = document.getElementById('cityReciver');

            if (!governateId) {
                citySelect.innerHTML = '<option value="" disabled selected>اختر المدينة</option>';
                citySelect.disabled = true;
                return;
            }

            fetch(`/get-cities/${governateId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="" disabled selected>اختر المدينة</option>';
                    data.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.id;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    });
                    citySelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                    alert('حدث خطأ أثناء تحميل المدن.');
                });
        });
    </script>
    <!-- make image browser file clickable -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const profileImage = document.getElementById('profileImage');
            const imageUpload = document.getElementById('imageUpload');

            // Trigger file browse when image is clicked
            profileImage.addEventListener('click', () => {
                imageUpload.click();
            });

            // Preview the selected image
            imageUpload.addEventListener('change', (event) => {
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        });
    </script>


</body>

</html>
