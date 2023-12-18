<!doctype html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>⚡ | Dashboard du Gard</title>
    <link rel="stylesheet" href="src/styles/globals.css" />
    <link rel="stylesheet" href="src/styles/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="src/javascript/charts.js" defer></script>
    <script src="src/javascript/utils.js" defer></script>
  </head>
  <body class="dark flex h-screen flex-col bg-background">
    <div class="flex w-screen grow flex-row" style="height: calc(100vh - 4rem)">
      <main class="h-full grow">  
        <?php require ('src/components/header.php'); ?>
        <div class="container mx-auto px-4 flex flex-col gap-10 mt-10">
          <dl class="grid w-full grid-cols-4 gap-10">
            <?php
                for ($i = 0; $i < 4; $i++) {
                    require ('src/components/card.php');
                }
            ?>
          </dl>
          <div
            class="flex flex-row gap-10"
          >
          <section
            class="h-80 rounded-lg border border-border bg-primary w-1/2 p-8 flex justify-between items-center gap-4"
          >
            <div
                class="w-2/3 h-full flex justify-center items-center flex-col gap-4"
                id="consoByYearContainer"
            >
              <h2
              class="w-full text-lg font-bold"
              >
                Consommation par année (en MWh)
              </h2>
              <canvas
                id="consoByYear"
                role="img"
              ></canvas>
            </div>
            <div
              class="h-full"
            >
                <ul
                  class="h-full flex flex-col justify-center items-center gap-2"
                >
            <?php

                $consos = array('Consommation totale', 'Consommation Agriculture', 'Consommation Industrie', 'Consommation Tertiaire', 'Consommation Résidentiel', 'Consommation Secteur Inconnu');

                require 'src/constants/colors.php';

                foreach ($consos as $conso) {
            ?>
                  <li
                    class="w-full"
                  >
                    <button
                      class="text-xs border-black border text-center p-2 w-full rounded <?= $conso == 'Consommation totale' ? 'bg-black text-white' : ''; ?>"
                      data-conso="<?= $conso; ?>"
                      data-color="<?= $colors[$conso]; ?>"
                      style="--color : <?= $colors[$conso]; ?>"
                      onclick="triggerConsoByYear(this)"
                    >
                    <?= $conso; ?>
                    </button>
                  </li>

            <?php
                }
            ?>
                </ul>
            </div>
          </section>
          <section
            class="h-80 rounded-lg border border-border bg-background w-1/2 flex justify-start items-center relative shadow-sm"
          ><aside
                class="absolute -top-5 rounded-lg left-10"
            >
                <ul class="flex items-center justify-center gap-4">
                  <li class="relative bg-background">
                    <button class="h-10 flex gap-3 text-text border border-border rounded items-center px-4 min-w-30 justify-between" id="year-button"
                    >
                      <span class="text-text" id="year-button-text">2021</span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    id="year-button-svg"
                    class="transition-transform"
                  ><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <ul
                      class="absolute border border-border rounded bg-background h-56 overflow-y-scroll top-12 left-0 w-30 transition-all capitalize opacity-0 pointer-events-none"
                      id="year-dropdown"
                    >
                    <?php

                        require 'src/constants/years.php';
                        foreach (YEARS as $year):
                    ?>
                        <li class="text-sm text-text capitalize">
                          <button
                            class="flex h-12 flex-row items-center gap-3 p-3 text-text capitalize tex-sm"
                            onclick="storeYear('<?= $year; ?>')"
                            data-year="<?= $year; ?>"
                          >
                            <span><?= $year; ?></span>
                          </button>
                        </li>
                      <?php
                        endforeach;
                    ?>
                    </ul>
                  </li>
                </ul>
            </aside>
            <div
              class="p-8 w-full h-full flex flex-row items-center gap-4"
            >
                        <div
                          class="h-full flex gap-4 flex-row items-center"
                        ><div
                          id="consoTypeContainer"
                          class="h-full"
                        >
                          <canvas
                            id="consoType"
                            role="img"
                          ></canvas>
                      </div>
                      <ul
                        id="consoTypeLegend"
                      ></ul></div>
                      <div
                class="w-[1px] bg-border h-5/6"
            ></div>
            <ul
                        id="topOperatorList"
                        class="grow h-full flex flex-col justify-center items-center gap-4 overflow-hidden"
            ></ul>
          </div>
            
        </section>
          </div>
          <section
            class="w-full h-80 rounded-lg border border-border bg-background relative p-8 flex flex-row gap-4 items-center shadow-sm"
          >
            
          <div
                class="h-full w-auto flex flex-col overflow-hidden grow"
            >
              <h2
              class="text-md font-bold text-text mb-4 text-center"
              >
                Production par type dans la région en 2021 (en MW)
              </h2>
              <div
                class="w-full grow h-[calc(100%-5rem)] flex flex-row items-center gap-4"
                id="typeOfProductionContainer"
              >
              <canvas
              id="typeOfProduction"
              role="img"
              width="0"
              height="0"
            ></canvas>
                <ul>
                  
                </ul>
          </div>
            </div>
            <div
                class="w-[1px] bg-border h-5/6"
            ></div>
            <div
                class="h-full w-auto grow"
            >
                <h2
                class="text-md font-bold text-text mb-4 text-center"
                
                >Consommation par mois dans la région en 2021 (en MW)</h2>
                <div
                  id="regionByMonthContainer"
                  class="w-full grow flex flex-row items-center gap-4 h-[calc(100%-2rem)]"
                >
                <canvas id="regionByMonth"></canvas>
                </div>
            </div>
            <div
              class="w-[1px] bg-border h-5/6"
            ></div>
            <div
                class="h-full w-auto grow">
                <h2
                class="text-md font-bold text-text mb-4 text-center"
                >Type de production par mois la région en 2021 (en MW)</h2>
                <div
                  id="prodByMonthContainer"
                  class="w-full grow flex flex-row items-center gap-4 h-[calc(100%-1rem)]"
                >
                <canvas id="prodByMonth"></canvas>
                </div>
            </div>
        </section>
        </div>
      </main>
<?php
require ('src/components/aside.php');
?>
    </div>
    <?php if (!isset($_GET['boosted'])): ?>
      <div
      class="dialog fixed z-20 inset-0 bg-black bg-opacity-50 transition-opacity w-screen h-screen flex items-center justify-center backdrop-blur-sm opacity-0 pointer-events-none"
      id="dialog"
    >
      <section
        class="bg-background border border-border rounded-lg shadow-lg p-4 text-text max-w-lg"
      >
          <h3
            class="text-2xl font-bold text-text"
          >Activer le mode boosté !</h3>
          <p
            class="mt-2 text-text"
          >Le mode boosté vous permet d'avoir accès aux grafiques de n'importe quel département. Avant de l'activer assurez-vous que toutes les bases de données nécessaires sont installées.</p>
          <div
            class="grid grid-cols-2 mt-4 gap-4"
          >
            <button
              class="flex h-10 flex-row items-center gap-3 p-3 text-text rounded-lg border border-border bg-background text-center"
              id="cancel-button"
              onclick="toggleDialog()"
            >
              Annuler
            </button>
            <a
              class="flex h-10 flex-row items-center gap-3 p-3 bg-primary hover:bg-primary-hover transition-all rounded-lg text-black text-center"
              id="confirm-button"
              href="?boosted=true"
            >
              Activer
            </a>
          </div>
      </section>
  </div>
    <?php endif; ?>
  </body>
</html>
