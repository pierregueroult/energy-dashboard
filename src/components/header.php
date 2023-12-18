<header class="h-16 w-full border-b border-border bg-background px-4">
          <div
            class="container mx-auto flex h-full w-full items-center justify-between"
          >
            <h2 class="text-2xl font-bold text-text">Dashboard ⚡</h2>
            <ul class="flex items-center justify-center gap-4">
            <?php if(isset($_GET['boosted'])) : ?>
                <li
                  class="relative"
                >
                <button
                  class="h-10 flex gap-3 text-text border border-border rounded items-center px-4 min-w-56 justify-between capitalize"
                  id="region-button"
                >
                  <span class="text-text"
                    id="region-button-text"
                  >Département</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    id="region-button-svg"
                    class="transition-transform"
                  ><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <ul
                  class="absolute border border-border rounded bg-background h-80 overflow-y-scroll top-12 left-0 w-56 opacity-0 pointer-events-none transition-all capitalize"
                  id="region-dropdown"
                >
                  <?php
                  
                  require('src/constants/deps.php');
                  require('src/utils/getAllKeysFromArray.php');

                  $keys = getAllKeysFromArray(DEPARTMENTS);

                  foreach ($keys as $key) :
                  ?>
                  <li
                    class="text-sm text-text capitalize"
                  >
                    <button
                      onclick="storeDepartement('<?= $key ?>')"
                    class="flex h-12 flex-row items-center gap-3 p-3 text-text capitalize">
                      <span><?= $key ?></span>
                    </button>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </li>
              <?php endif; ?>
              <li
                class="flex h-10 w-10 items-center justify-center rounded border border-border bg-background"
              >
                <button
                  class="flex h-full w-full items-center justify-center text-text transition-all"
                  id="dark-mode-button"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="sun absolute transition-all"
                  >
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2" />
                    <path d="M12 20v2" />
                    <path d="m4.93 4.93 1.41 1.41" />
                    <path d="m17.66 17.66 1.41 1.41" />
                    <path d="M2 12h2" />
                    <path d="M20 12h2" />
                    <path d="m6.34 17.66-1.41 1.41" />
                    <path d="m19.07 4.93-1.41 1.41" />
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="moon absolute transition-opacity"
                  >
                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
                  </svg>
                </button>
              </li>
              <li
                class="flex h-10 w-10 items-center justify-center rounded border border-border bg-background"
              >
                <button
                  class="flex h-full w-full items-center justify-center text-text"
                  id="menu-button"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="lucide lucide-menu"
                  >
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                  </svg>
                </button>
              </li>
            </ul>
          </div>
        </header>