# Wings

Wings adds eighteen particle wing effects to Axolotl-PM. Players can switch an effect with `/wings <effect>` or turn it off with `/wings off`. The historical effect commands remain available as aliases.

## Effects

`angry`, `bubble`, `critical`, `enchant`, `flame`, `fire`, `happy`, `heart`, `lava-drip`, `lava`, `mob-spell`, `portal`, `rain`, `redstone`, `smoke`, `spore`, `water-drip` and `water`.

Only one effect runs per player at a time. Effects last for the current session and are cleared when the player disconnects. The default update interval is one server tick and can be adjusted in `config.yml`.

## Compatibility and verification

Wings requires Axolotl-PM API 5.0.0 or newer. CI runs PHPStan at maximum level and builds against pinned API 5.0.0 and 5.49.1 source revisions. The generated PHAR is smoke-tested on Axolotl-PM 5.49.1. Particle visuals should be confirmed with a connected Bedrock client.

The `main` branch now contains the maintained API 5 plugin. The eighteen previous standalone plugins remain available as historical source branches:

- [AngryWings](https://github.com/NhanAZ-Plugins/Wings/tree/AngryWings)
- [BubbleWings](https://github.com/NhanAZ-Plugins/Wings/tree/BubbleWings)
- [CriticalWings](https://github.com/NhanAZ-Plugins/Wings/tree/CriticalWings)
- [EnchantmentTableWings](https://github.com/NhanAZ-Plugins/Wings/tree/EnchantmentTableWings)
- [EntityFlameWings](https://github.com/NhanAZ-Plugins/Wings/tree/EntityFlameWings)
- [FireWings](https://github.com/NhanAZ-Plugins/Wings/tree/FireWings)
- [HappyWings](https://github.com/NhanAZ-Plugins/Wings/tree/HappyWings)
- [HeartWings](https://github.com/NhanAZ-Plugins/Wings/tree/HeartWings)
- [LavaDripWings](https://github.com/NhanAZ-Plugins/Wings/tree/LavaDripWings)
- [LavaWings](https://github.com/NhanAZ-Plugins/Wings/tree/LavaWings)
- [MobSpellWings](https://github.com/NhanAZ-Plugins/Wings/tree/MobSpellWings)
- [PortalWings](https://github.com/NhanAZ-Plugins/Wings/tree/PortalWings)
- [RainSplashWings](https://github.com/NhanAZ-Plugins/Wings/tree/RainSplashWings)
- [RedstoneWings](https://github.com/NhanAZ-Plugins/Wings/tree/RedstoneWings)
- [SmokeWings](https://github.com/NhanAZ-Plugins/Wings/tree/SmokeWings)
- [SporeWings](https://github.com/NhanAZ-Plugins/Wings/tree/SporeWings)
- [WaterDripWings](https://github.com/NhanAZ-Plugins/Wings/tree/WaterDripWings)
- [WaterWings](https://github.com/NhanAZ-Plugins/Wings/tree/WaterWings)

Wings is authored by NhanAZ and distributed under the [MIT License](LICENSE).
