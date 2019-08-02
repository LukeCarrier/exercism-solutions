class Series
  def initialize(series)
    @series = series
  end

  def slices(length)
    raise ArgumentError.new('Slice length cannot be > series length') unless @series.length >= length
    @series.chars.each_cons(length).map(&:join)
  end
end
