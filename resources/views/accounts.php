<div class="ml-2">
    <div class="text-gray-100">
        Block: <?php echo $blockNumber; ?>
        <span class="ml-2 text-gray-50">〉</span>
        Gas price: <?php echo $gasPrice; ?>
    </div>

    <div class="mt-1">
        <span class="w-42 text-gray-50">
            <b class="text-gray-100">Accounts</b> <?php echo str_repeat('.',  100) ?>
        </span>
        <span class="ml-2 font-bold text-gray-100">ETH</span>
    </div>

    <?php foreach ($accounts as $address => $balance) { ?>
        <div>
            <span class="text-gray"><?php echo $address ?></span>
            <span class="ml-2 w-3 text-right"><?php echo $balance->toEth() ?></span>
        </div>
    <?php } ?>
</div>
