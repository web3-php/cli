<div>

    <div class="ml-2 mb-1">
        <span class=" text-gray-100">Block:</span> <?php echo $blockNumber; ?>
        <span class=" text-gray-50 ml-2"> 〉</span> <span class=" text-gray-100">Gas price:</span> <?php echo $gasPrice; ?>
    </div>

    <div>
        <span class="ml-2"><strong class="text-gray-100">Accounts</strong></span> <span class="text-gray-50 w-33"><?php echo str_repeat('.',  100) ?></span>
        <span class="font-bold text-right ml-2 text-gray-100">ETH</span>
    </div>

    <?php foreach ($accounts as $address => $balance) { ?>
        <div>
            <span class="ml-2 text-gray"><?php echo $address ?></span>
            <span class="text-right ml-2"><?php echo $balance->toEth() ?></span>
        </div>
    <?php } ?>
</div>
