document.addEventListener('DOMContentLoaded', () => {
    const inputBusqueda = document.getElementById('input-busqueda');
    const boxSugerencias = document.getElementById('box-sugerencias');
    const listaSugerencias = document.getElementById('lista-sugerencias');
    const btnLimpiar = document.getElementById('btn-limpiar');

    if (inputBusqueda) {
        // Cálculo dinámico de profundidad según la ruta del navegador
        const pathname = window.location.pathname;
        const enCarpetaPhp = pathname.includes('/php/');
        
        let prefijoRaiz = '';
        let rutaFetch = 'php/buscar_sugerencias.php';
        let rutaRedireccion = 'php/busquedas.php';

        if (enCarpetaPhp) {
            const partes = pathname.split('/php/');
            const subcarpetas = (partes[1].match(/\//g) || []).length;

            if (subcarpetas === 0) {
                // Estamos en /php/ (ej. php/perros.php)
                prefijoRaiz = '../';
                rutaFetch = 'buscar_sugerencias.php';
                rutaRedireccion = 'busquedas.php';
            } else {
                // Estamos en subcarpetas de php (ej. php/PerrosCategorias/PerroCategoriaPaseo.php)
                prefijoRaiz = '../'.repeat(subcarpetas + 1);
                rutaFetch = '../'.repeat(subcarpetas) + 'buscar_sugerencias.php';
                rutaRedireccion = '../'.repeat(subcarpetas) + 'busquedas.php';
            }
        }

        inputBusqueda.addEventListener('input', function() {
            const query = this.value.trim();
            
            if (query.length > 0) {
                if (btnLimpiar) btnLimpiar.style.display = 'block';
                
                fetch(`${rutaFetch}?q=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error en el servidor');
                        return response.json();
                    })
                    .then(data => {
                        listaSugerencias.innerHTML = '';
                        
                        if (data.length > 0) {
                            data.forEach(item => {
                                const li = document.createElement('li');
                                li.classList.add('sugerencia-item');
                                
                                // Resaltar texto coincidente
                                const regex = new RegExp(`(${query})`, 'gi');
                                const nombreResaltado = item.nombre.replace(regex, '<mark>$1</mark>');
                                
                                // Ajuste dinámico de ruta de imagen
                                const imgFinal = item.imagen ? `${prefijoRaiz}${item.imagen}` : `${prefijoRaiz}img/img_menuprincipal/Logo.jpg`;
                                const imgFallback = `${prefijoRaiz}img/img_menuprincipal/Logo.jpg`;
                                
                                li.innerHTML = `
                                    <img src="${imgFinal}" alt="${item.nombre}" class="sugerencia-img" onerror="this.src='${imgFallback}'">
                                    <div class="sugerencia-info">
                                        <span class="sugerencia-nombre">${nombreResaltado}</span>
                                        <span class="sugerencia-precio">$${parseFloat(item.precio).toFixed(2)}</span>
                                    </div>
                                `;
                                
                                // Redirección a resultados
                                li.addEventListener('click', () => {
                                    window.location.href = `${rutaRedireccion}?busqueda=${encodeURIComponent(item.nombre)}`;
                                });
                                
                                listaSugerencias.appendChild(li);
                            });
                            boxSugerencias.classList.remove('hidden');
                        } else {
                            boxSugerencias.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error cargando sugerencias:', error);
                        boxSugerencias.classList.add('hidden');
                    });
            } else {
                if (btnLimpiar) btnLimpiar.style.display = 'none';
                boxSugerencias.classList.add('hidden');
            }
        });

        // Limpieza del buscador
        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', () => {
                inputBusqueda.value = '';
                btnLimpiar.style.display = 'none';
                boxSugerencias.classList.add('hidden');
                inputBusqueda.focus();
            });
        }

        // Ocultar al dar clic fuera
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-container')) {
                boxSugerencias.classList.add('hidden');
            }
        });
    }
});