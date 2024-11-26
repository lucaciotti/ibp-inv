sail artisan make:controller PlannedTaskController

//Se view con DynamicContent
sail artisan livewire:make Warehouses/Ubications/Content
sail artisan livewire:make Warehouses/Ubications/UbicationModalEdit
sail artisan make:datatable Warehouses/Ubications/UbicationTable Ubication


sail artisan livewire:make PlanImportFile/PlanImportFileModal

sail artisan livewire:make PlanImportFile/PlanImportFileModalEdit

<!-- JOBS -->
sail artisan make:job ProcessTempTasks

<!-- EXCEL -->
sail artisan make:import UsersImport --model=User

sail artisan make:export PlannedTaskExport --model=PlannedTask

apt install libfontconfig1 libxrender1

docker exec -u root mcslide-app-laravel.test-1 apt update
docker exec -u root mcslide-app-laravel.test-1 apt install libfontconfig1 libxrender1


sail artisan mak:model InventorySessionWarehouse --migration
sail artisan make:migration add_num_ticket --table='inventory_session_tickets'