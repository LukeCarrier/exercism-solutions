pub fn is_armstrong_number(num: u32) -> bool {
    let count = (num as f32).log10() as u32 + 1;
    let mut sum = 0;
    let mut work = num;

    while work > 0 {
        sum += (work % 10).pow(count);
        work /= 10;
    }
    num == sum
}
