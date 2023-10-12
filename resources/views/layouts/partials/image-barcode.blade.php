
                    <a download="{{ $item }}.png"
                        href="data:image/png;base64,{{ DNS2D::getBarcodePNG(url('/detail-barang', $item), 'QRCODE', 200, 200) }}"
                        target="_blank">
                        <div class="bg-white p-1 rounded-sm" style="height: 30px">
                            {!! '<img class="mb-3" src="data:image/png;base64,' .
                                DNS2D::getBarcodePNG($item, 'QRCODE', 1, 1) .
                                '" alt="' .
                                $item .
                                '"   />' !!}
                        </div>
                    </a>
