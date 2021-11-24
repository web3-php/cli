<div>
    <div>
        <span class="ml-2"><strong class="text-gray-100">Wallets</strong></span> <span class="text-gray-50 w-34"><?php echo str_repeat('.',  100) ?></span>
        <span class="font-bold text-right ml-2 text-gray-100">ETH</span>
    </div>

    <?php foreach ($accounts as $address => $balance) { ?>
        <div>
            <span class="ml-2 text-gray"><?php echo $address ?></span>
            <span class="font-bold text-right ml-2"><?php echo $balance->toEth() ?></span>
        </div>
    <?php } ?>
</div>
